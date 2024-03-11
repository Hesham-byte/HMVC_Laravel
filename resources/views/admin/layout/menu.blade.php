<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class=" nav-item">
          <a href="{{ route('admin.dashboard') }}"> <i class="icon-home"></i> {{ __('main.dashboard') }}</a>
        </li>

        @can('users')
          <li class=" nav-item">
            <a href="{{ route('admin.users.index') }}"> <i class="fa fa-users"></i> {{ __('users.users') }}</a>
          </li>
        @endcan

        @can('customers')
          <li class=" nav-item">
            <a href="{{ route('admin.customers.index') }}"> <i class="far fa-user-circle"></i> {{ __('customers::common.customers') }}</a>
          </li>
        @endcan

        @can('merchant')
          <li class=" nav-item">
            <a href="{{ route('admin.merchants.index') }}"> <i class="fas fa-briefcase"></i> {{ __('merchant::common.merchants') }}</a>
          </li>
        @endcan

        @can('famous')
          <li class=" nav-item">
            <a href="{{ route('admin.famous.index') }}"> <i class="fas fa-user-tie"></i> {{ __('famous::common.famous') }}</a>
          </li>
        @endcan

          @can('productscategory')
              <li class=" nav-item">
                  <a href="{{ route('admin.productscategory.index') }}"> <i class="fa fa-list"></i> {{ __('productscategory::common.productscategory') }}</a>
              </li>
          @endcan

          @can('products')
              <li class=" nav-item">
                  <a href="{{ route('admin.products.index') }}"> <i class="fa fa-list-ol"></i> {{ __('products::common.products') }}</a>
              </li>
          @endcan

          <hr style="background: white;">

          @can('banners')
              <li class=" nav-item">
                  <a href="{{ route('admin.banners.index') }}"> <i class="fa fa-image"></i>  {{ __('banners::common.banners') }}</a>
              </li>
          @endcan
          @can('tags')
              <li class=" nav-item">
                  <a href="{{ route('admin.tags.index') }}"> <i class="fa fa-address-book"></i>  {{ __('tags::common.tags') }}</a>
              </li>
          @endcan


      @can('countries')
              <li class=" nav-item">
                  <a href="{{ route('admin.countries.index') }}"> <i class="fa fa-globe"></i> {{ __('main.countries') }}</a>
              </li>
          @endcan

          @can('advertises')
              <li class=" nav-item">
                  <a href="{{ route('admin.advertises.index') }}"> <i class="fa fa-list"></i> {{ __('advertises::common.advertises') }}</a>
              </li>
          @endcan

          @can('tax')
              <li class=" nav-item">
                  <a href="{{ route('admin.tax.index') }}"> <i class="fa fa-money"></i>  {{ __('tax::common.tax') }}</a>
              </li>
          @endcan


          {{-- ============================================================================================================= --}}
        <hr style="background: white;">
        <li class=" nav-item">
          <a href="{{ route('admin.admins.index') }}"> <i class="fas fa-users-cog"></i> {{ __('users.admins') }}</a>
        </li>
        <li class=" nav-item">
          <a href="{{ route('admin.roles.index') }}"> <i class="fas fa-shield-alt"></i> {{ __('main.roles') }}</a>
        </li>
      </ul>
    </div>
  </div>
