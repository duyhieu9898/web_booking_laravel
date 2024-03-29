<footer id="sticky-footer" class="text-white-50">
    <div class="footer__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                <h4>{{ $dataFooter['footer_left_title'] }}</h4>
                    <ul>
                        <li><i class="fa fa-map-marker"></i>&nbsp;{{ $dataFooter['footer_left_address'] }}
                        </li>
                        <li><i class="fa fa-phone"></i>&nbsp;{{ $dataFooter['footer_left_phone'] }}</li>
                        <li><i class="fa fa-envelope-o"></i>&nbsp;{{ $dataFooter['footer_left_mail'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>{{ $dataFooter['footer_mid_title'] }}</h4>
                    <ul>
                        <li><i class="fa fa-map-marker"></i>&nbsp;{{ $dataFooter['footer_mid_address'] }}
                        </li>
                        <li><i class="fa fa-phone"></i>&nbsp;{{ $dataFooter['footer_mid_phone'] }}</li>
                        <li><i class="fa fa-envelope-o"></i>&nbsp;{{ $dataFooter['footer_left_mail'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4>{{ $dataFooter['footer_right_title'] }}</h4>
                    <div class="fb-page"
                        data-href="{{ $dataFooter['footer_right_facebook'] }}"
                        data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                        data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/duyhieu9889/" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/duyhieu9889/">Thuê Phòng Trọ</a>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center footer__listence"><small>Copyright &copy; 2019 - All rights reserved</small></div>
</footer>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
</script>
