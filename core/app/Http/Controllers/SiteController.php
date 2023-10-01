<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Frontend;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\Brand;

class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){
        $banners          = Frontend::where('data_keys', 'banner.element')->latest()->get();
        $featuredProducts = Product::where('status',1)
                                        ->whereHas('brand', function($q){
                                            $q->where('status', 1);
                                        })
                                        ->whereHas('category', function($q){
                                            $q->where('status', 1);
                                        })->where('featured',1)->take(12)->latest()->get();

        $latestProducts   = Product::where('status',1)
                                        ->whereHas('brand', function($q){
                                            $q->where('status', 1);
                                        })
                                        ->whereHas('category', function($q){
                                            $q->where('status', 1);
                                        })->latest()->take(6)->latest()->get();

        $hotDealProducts  = Product::where('status',1)
                                        ->whereHas('brand', function($q){
                                            $q->where('status', 1);
                                        })
                                        ->whereHas('category', function($q){
                                            $q->where('status', 1);
                                        })
                                        ->where('hot_deal',1)->inRandomOrder()->take(7)->get();
        $pageTitle        = 'Home';

        return view($this->activeTemplate . 'home', compact('pageTitle', 'banners','featuredProducts','latestProducts','hotDealProducts'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact',compact('pageTitle'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        $random             = getNumber();
        $ticket             = new SupportTicket();
        $ticket->user_id    = auth()->id() ?? 0;
        $ticket->name       = $request->name;
        $ticket->email      = $request->email;
        $ticket->priority   = 2;
        $ticket->ticket     = $random;
        $ticket->subject    = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status     = 0;
        $ticket->save();

        $adminNotification              = new AdminNotification();
        $adminNotification->user_id     = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title       = 'A new support ticket has opened ';
        $adminNotification->click_url   = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message                        = new SupportMessage();
        $message->supportticket_id     = $ticket->id;
        $message->message               = $request->message;
        $message->save();

        $notify[]                       = ['success', 'Ticket created successfully'];
        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blogDetails($slug, $id){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $latestBlogs = Frontend::where('data_keys','blog.element')->latest()->take(8)->get();
        $pageTitle = 'Blog Details';
        return view($this->activeTemplate.'blog_details',compact('blog','pageTitle', 'latestBlogs'));
    }


    public function cookieAccept(){
        session()->put('cookie_accepted',true);
        $notify[] = ['success','Cookie accepted successfully'];
        return back()->withNotify($notify);
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }


    public function about(){
        $pageTitle = 'About Us';
        $content = getContent('about.content', true);
        return view($this->activeTemplate.'about',compact('pageTitle', 'content'));
    }

    public function faq(){
        $pageTitle = 'Frequently Asked Questions';
        $content = getContent('faq.content', true);
        $faqs = getContent('faq.element', false,  null, true);
        return view($this->activeTemplate.'faq',compact('pageTitle', 'content', 'faqs'));
    }

    public function page($policy, $id){
        $content = Frontend::where('data_keys','policy_pages.element')->where('id', $id)->firstOrFail();
        $pageTitle = ucfirst($policy);
        return view($this->activeTemplate.'page',compact('pageTitle', 'content'));
    }

    public function blogs(){
        $pageTitle = 'Blogs';
        $blogs = Frontend::where('data_keys', 'blog.element')->latest()->paginate(getPaginate());
        return view($this->activeTemplate.'blogs',compact('pageTitle', 'blogs'));
    }

    public function products(Request $request){
        $pageTitle  = 'Products';
        $brands     = Brand::where('status',1)->get();


        $products   = Product::filters()
                            ->whereHas('brand', function($q){
                                $q->where('status', 1);
                            })
                            ->whereHas('category', function($q){
                                $q->where('status', 1);
                            })
                            ->with(['brand','category'])
                            ->where('status',1)
                            ->latest()
                            ->paginate(getPaginate());
        return view($this->activeTemplate.'products', compact('pageTitle','products','brands'));
    }

    public function productDetails($id,$slug)
    {
        $pageTitle = "Product Details";
        $product  = Product::findOrFail($id);

        $relatedProducts = Product::where('id','!=',$product->id)->where('category_id',$product->category_id)->inRandomOrder()->take(4)->get();


        return view($this->activeTemplate.'product_details',compact('pageTitle','product','relatedProducts'));
    }

    public function checkOut($id, $slug)
    {
        $pageTitle = "Checkout";
        $product  = Product::findOrFail($id);
        return view($this->activeTemplate.'checkout',compact('pageTitle','product'));
    }

}
