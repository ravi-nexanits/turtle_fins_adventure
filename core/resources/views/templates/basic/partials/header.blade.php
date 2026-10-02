@php
    $contact_content = getContent('contact.content', true);
    $socials = getContent('social_icon.element',false,null,true);
@endphp
<meta name="facebook-domain-verification" content="dpo4tvbjx1et5x33f1fae90c8bshxz" />
<!-- Meta Pixel Code -->
<script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=3c96b1d9e6305' async='true'></script>
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '577980857341043');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=577980857341043&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=3c96b1d9e6305' async='true'></script>
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-bar-area">
                <ul class="phone-number">
                    <li>
                        <a href="#0"><i class="las la-phone"></i> +918900928786 / +919474293476</a>
                    </li>
                    <li>
                        <a href="#0"><i class="las la-envelope"></i> {{ $contact_content->data_values->email }}</a>
                    </li>
                </ul>
                <ul class="social-icons">
                    @foreach($socials as $social)
                    <li>
                        <a href="{{ $social->data_values->url }}">@php echo $social->data_values->social_icon @endphp</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0 align-items-center">
                <a class="site-logo site-title" href="{{ route('home') }}"><img
                        src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu ms-auto">
                        <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                        @foreach($pages as $k => $data)
                            <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                        @endforeach
                        <li><a href="{{ route('plans') }}">@lang('Tour Package')</a></li>
                        <li><a href="{{ route('albums') }}">@lang('Gallery')</a></li>
                        <!--<li><a href="{{ route('seminars') }}">@lang('Seminar Package')</a></li>-->
                        <li><a href="{{ route('blogs') }}">@lang('Blog')</a></li>
                        <li><a href="{{ route('contact') }}">@lang('Contact')</a></li>
                    </ul>
                    <div class="nav-right">
                        <select class="langSel language-select me-3">
                            @foreach($language as $item)
                                <option value="{{$item->code}}"
                                        @if(session('lang') == $item->code) selected @endif>{{ __($item->name) }}</option>
                            @endforeach
                        </select>
                        @auth
                            <a href="{{ route('user.home') }}" class="btn btn-md btn--base d-flex align-items-center"><i
                                    class="las la-tachometer-alt fs--18px me-2"></i> @lang('Dashboard')</a>
                        @else
                            <a href="{{ route('user.login') }}" class="btn btn-md btn--base d-flex align-items-center"><i
                                    class="las la-user fs--18px me-2"></i> @lang('Login')</a>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header__bottom end -->
</header>
