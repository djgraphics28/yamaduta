<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        // Insert data into the 'abouts' table
        DB::table('abouts')->insert([
            'company_history' => '<p>Founded in 2018, <strong>YAMADUTA CLOTHING</strong> was born out of a passion for fashion and a desire to create high-quality, locally-made clothing that reflects our unique style.</p>',
            'founder_message' => '<p>Hi, I\'m Moncedrick Gallos, the founder of <strong>YAMADUTA CLOTHING</strong>. I started this company with a vision to bring locally designed and crafted fashion to our community. Thank you for supporting us on this journey.</p>',
            'mission_statement' => '<p>The <strong>YAMADUTA CLOTHING</strong>, our mission is to inspire confidence and self-expression through comfortable and stylish clothing that\'s sustainably produced right here in [Pasig City].</p>',
            'community_involvement' => '<p>Giving back to our community is important to us. We regularly collaborate with local charities and organizations to support causes that matter to our customers.</p>',
            'social_media_links' => '<p>Stay connected with us on social media for the latest updates, promotions, and a sneak peek behind the scenes of our design process.</p>',
            'created_at' => '2023-09-28 23:30:54',
            'updated_at' => '2023-09-28 23:30:54',
        ]);
    }
}
