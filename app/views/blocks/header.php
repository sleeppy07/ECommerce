<header class="header" >
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
                <nav class="main-nav" style = "width:1100px">
                    <ul class="menu sf-arrows">
                    <?php var_dump(_WEB_ROOT.'/Categories/ListCategory')?>
                    @foreach(_WEB_ROOT.'/Categories/ListCategory' as $item) 
                        <li><a href="?mod=product&act=main&cat_id={{$item['Id']}}" class="">{{$item['Name']}}</a>
                        </li>
                        @endforeach
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