<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= preg_replace('#<[^>]*>#', '', $page_title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php if (isset($meta_description)): ?>
    <meta name="description" content="<?= _htmlentities($meta_description) ?>">
    <?php endif; ?>
    <meta name="keywords" content="<?= _htmlentities($meta_keywords); ?>">
    <?php
        if (!empty($robots)) {
            echo '<meta name="robots" content="' . $robots . '">';
        }
    ?>

    <link rel="author" title="Send feedback" href="mailto:<?= str_replace('@', '&#64;', CONTACTEMAIL) ?>">
    <link rel="home" title="Home" href="https://<?= DOMAIN ?>/">

    <meta property="og:site_name" content="TheyWorkForYou">
    <meta property="og:url" content="<?= _htmlentities($page_url) ?>">
    <meta property="og:title" content="<?= preg_replace('#<[^>]*>#', '', $page_title) ?>">
    <?php if ($og_image) { ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@theyworkforyou">
    <meta name="twitter:creator" content="@theyworkforyou">
      <meta property="og:image" content="<?= $og_image ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1000">
    <meta property="og:image:height" content="500">
    <meta property="og:type" content="profile">
    <?php } else { ?>
    <meta property="og:type" content="website">
      <meta property="og:image" content="https://<?= DOMAIN ?>/images/facebook-avatar.png">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">
    <?php } ?>
    <meta property="og:description" content="<?= _htmlentities($meta_description) ?>">
    <meta property="fb:app_id" content="<?= FACEBOOK_APP_ID ?>">

    <script type="text/javascript" src="<?= cache_version("js/jquery-1.11.3.min.js") ?>"></script>
    <script type="text/javascript" src="<?= cache_version("js/jquery.cookie.js") ?>"></script>
    <script type="text/javascript" src="<?= cache_version("js/jquery.fittext.js") ?>"></script>
    <script type="text/javascript" src="<?= cache_version("js/main.js") ?>"></script>
    <script async src="<?= cache_version('js/loading-attribute-polyfill.min.js') ?>"></script>

    <?php foreach ($header_links as $link): ?>
    <link rel="<?= $link['rel'] ?>" title="<?= $link['title'] ?>" href="<?= $link['href'] ?>">
    <?php endforeach; ?>

    <link rel="stylesheet" href="<?= cache_version("style/stylesheets/app.css") ?>" type="text/css">
    <!--[if IE 8]><link rel="stylesheet" href="<?= cache_version("style/stylesheets/ie8.css") ?>" type="text/css"><![endif]-->
    <script type="text/javascript" src="<?= cache_version("js/respond.min.js") ?>"></script>

    <?php if (isset ($page_rss_url)): ?>
    <link rel="alternate" type="application/rss+xml" title="TheyWorkForYou RSS" href="<?= $page_rss_url ?>">
    <?php endif; ?>

    <link rel="apple-touch-icon" href="/images/apple-touch-60.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/images/apple-touch-76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-touch-120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/images/apple-touch-152.png" />

    <?php if (!DEVSITE): ?>

    <script type="text/javascript">

        (function (i,s,o,g,r,a,m) {i['GoogleAnalyticsObject']=r;i[r]=i[r]||function () {
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-660910-1');  // Replace with your property ID.
        ga('set', 'anonymizeIp', true);
        ga('send', 'pageview');

        function trackFormSubmit(form, category, name, value) {
            try {
                ga('send', 'event', category, name, value);
            } catch (err) {}
            setTimeout(function () {
                form.submit();
            }, 100);
        }

        function trackLinkClick(link, category, name, value) {
            try {
                ga('send', 'event', category, name, value);
            } catch (err) {}
            setTimeout(function () {
                document.location.href = link.href;
            }, 100);
        }
    </script>

<?php endif; ?>

    <script>window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };

      return t;
    }(document, "script", "twitter-wjs"));</script>

    <script>
      twttr.ready(function() {
        twttr.events.bind('tweet', function() {
            ga('send', 'social', 'twitter', 'tweet', window.location.href);
        });
        twttr.events.bind('follow', function() {
            ga('send', 'social', 'twitter', 'follow', window.location.href);
        });
      });
    </script>

</head>

<body>

    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
            appId      : <?= json_encode(FACEBOOK_APP_ID) ?>,
            xfbml      : true
            });

            FB.Event.subscribe('edge.create', function (targetUrl) {
                ga('send', 'social', 'facebook', 'like', targetUrl);
            });

            FB.Event.subscribe('edge.remove', function (targetUrl) {
                ga('send', 'social', 'facebook', 'unlike', targetUrl);
            });

            FB.Event.subscribe('message.send', function (targetUrl) {
                ga('send', 'social', 'facebook', 'share', targetUrl);
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/all.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

  <?php if ( $banner_text ) { ?>
    <div class="banner">
        <div class="full-page__row">
            <div class="banner__content">
                <?= $banner_text ?>
            </div>
        </div>
    </div>
  <?php } ?>

  <div class="crowdfunding-topper js-show-during-crowdfunder">
    <div class="full-page__row">
      <div class="full-page__unit">
        <p><strong>Only <span class="js-crowdfunder-time-left">a few days</span> to go:</strong> We’re raising £25,000 to keep TheyWorkForYou running and make sure people across the UK can hold their elected representatives to account.</p>
        <a class="button button--negative" href="https://www.crowdfunder.co.uk/theyworkforyou" data-track-click="crowdfunder-header">Donate to our crowdfunder</a>
      </div>
    </div>
  </div>

  <?php if (isset($country) && in_array($country, array('AU', 'IE', 'CA'))) { ?>
    <div class="banner">
        <div class="full-page__row">
            <div class="banner__content">
              <?php if ($country == 'AU') { ?>
                You&rsquo;re in Australia, so check out <a href="http://www.openaustralia.org">OpenAustralia</a>, a TheyWorkForYou for down under
              <?php } elseif ($country == 'IE') { ?>
                Check out <a href="https://www.kildarestreet.com/">KildareStreet</a>, a TheyWorkForYou for the Houses of the Oireachtas
              <?php } elseif ($country == 'CA') { ?>
                Check out <a href="https://openparliament.ca/">OpenParliament.ca</a>
              <?php } ?>
            </div>
        </div>
    </div>
  <?php } ?>


    <header class="site-header">
        <div class="site-header__row">

            <h1 class="site-header__logo">
                <a href="/">TheyWorkForYou</a>
            </h1>

            <a href="#main-nav" class="site-header__mobile-nav-toggle js-toggle">
                Menu
                <span></span>
            </a>

        </div>
    </header>

    <nav class="site-nav" id="main-nav">
        <div class="site-nav__primary">
            <div class="site-nav__row">

                <div class="site-nav__assembly">
                    <a href="#nav-assemblies" class="site-nav__dropdown-toggle js-toggle js-toggle-until-click-outside">
                        <?= $assembly_nav_current ?>
                    </a>
                    <ul id="nav-assemblies" class="site-nav__assembly__dropdown" aria-label="Available assemblies">
                      <?php foreach ($assembly_nav_links as $nav_link) { ?>
                        <li><a href="<?= $nav_link['href']; ?>" title="<?= $nav_link['title']; ?>" class="<?= $nav_link['classes']; ?>">
                            <?= $nav_link['text'] ?>
                        </a></li>
                      <?php } ?>
                    </ul>
                </div>

                <div class="site-nav__search">
                    <form action="/search/">
                        <label for="site-header-search">Search TheyWorkForYou</label>
                        <div class="row collapse">
                            <div class="small-9 columns">
                                <input type="search" id="site-header-search" name="q" placeholder="e.g. a postcode, person, or topic">
                            </div>
                            <div class="small-3 columns">
                                <button type="submit" class="prefix">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="site-nav__user">
                    <ul>
                      <?php foreach ($user_nav_links as $nav_link){ ?>
                        <li><a href="<?= $nav_link['href']; ?>" title="<?= $nav_link['title']; ?>" class="<?= $nav_link['classes']; ?>">
                            <?= $nav_link['text'] ?>
                        </a></li>
                      <?php } ?>
                    </ul>
                </div>

            </div>
        </div>

        <div class="site-nav__secondary">
            <div class="site-nav__row">

                <div class="site-nav__general">
                    <ul>
                      <?php foreach ($section_nav_links as $nav_link) { ?>
                        <li>
                            <a href="<?= $nav_link['href']; ?>" title="<?= $nav_link['title']; ?>" class="<?= $nav_link['classes']; ?>">
                                <?= $nav_link['text'] ?>
                            </a>
                        </li>
                      <?php } ?>
                    </ul>
                </div>

            </div>
        </div>
    </nav>

    <?php if (isset($page_errors)) { ?>
    <div class="full-page legacy-page static-page">
        <div class="full-page__row">
            <div class="panel">
            <?php foreach ( $page_errors as $error ) { ?>
                <p><?= $error['text'] ?></p>
            <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
