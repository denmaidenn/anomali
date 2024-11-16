<nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-custom">
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between w-100">
        <button class="navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3" type="button" data-toggle="minimize">
            <span class="navbar-toggler-icon"></span>
        </button>

        <button class="navbar-toggler d-lg-none navbar-dark" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div>
            <span>{{ Auth::user()->name }}</span>    
        </div>
    </div>
</nav>
