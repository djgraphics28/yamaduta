<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">	
</head>
<body>
@extends('yamaduta.frontend');
@section('content')
    <center>
    <h3 class="title" style="padding-top: 80px">ABOUT US</h3>
    </center>   
    <button class="accordion">Company Story</button>
<div class="panel">
  <p>Founded in 2018, YAMADUTA CLOTHING was born out of a passion for fashion and a desire to create high-quality, locally-made clothing that reflects our unique style.</p>
</div>

<button class="accordion">Founder's Message</button>
<div class="panel">
  <p>Hi, I'm Moncedrick Gallos , the founder of [Local Brand Name]. I started this company with a vision to bring locally designed and crafted fashion to our community. Thank you for supporting us on this journey.</p>
</div>

<button class="accordion">Mission Statement</button>
<div class="panel">
  <p>The YAMADUTA CLOTHING, our mission is to inspire confidence and self-expression through comfortable and stylish clothing that's sustainably produced right here in [Pasig City].</p>
</div>
<button class="accordion">Community Involvement</button>
<div class="panel">
  <p>Giving back to our community is important to us. We regularly collaborate with local charities and organizations to support causes that matter to our customers.</p>
</div>
<button class="accordion margin-top: 20px">Social Media Links</button>
<div class="panel padding-top: 20px padding-bottom: 20px">
  <p>Stay connected with us on social media for the latest updates, promotions, and a sneak peek behind the scenes of our design process.</p>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
</body>

    @endsection