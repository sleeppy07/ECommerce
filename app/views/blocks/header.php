<header class="header">
    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="" class="logo">
                    <img src="<?php echo _WEB_ROOT; ?>/end_user/assets/images/logo.png" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active"><a href="?" class="">Home</a></li>
                        <li><a href="?mod=page&act=detail&id=1" class="">About</a>
                        <li><a href="?mod=product&act=main&cat_id=1" class="">Laptop</a>
                        <li><a href="?mod=product&act=main&cat_id=2" class="">Macbook</a>
                        <li><a href="?mod=product&act=main&cat_id=3" class="">Mobile</a>
                        <li><a href="?mod=page&act=detail&id=2" class="">Contact</a>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <div class="dropdown cart-dropdown">
                    <a href="<?php echo '?mod=cart&act=view' ?>" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span style="margin-bottom: 20px; margin-left:-10px" class="cart-count"><?php echo isset($_SESSION['cart']) ? $_SESSION['cart']['info']['num_orders']: 0; ?></span>
                    </a>
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
                <div style="padding-left: 2.5rem;" class="header-top">
                    <a class="header-right" href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a>
                </div><!-- End .header-top -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->