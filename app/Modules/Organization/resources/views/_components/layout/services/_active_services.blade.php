@foreach($active_services as $service)
    <!-- For All services -->
    @if($service == 1)
        @include('Organization::_components.layout.services.all')
        @break;
    @endif

    <!-- only for clubs -->
    @if($service == 2)
         @include('Organization::_components.layout.services.club')
    @endif
    <!-- only for hotels -->
    @if($service == 3)
        @include('Organization::_components.layout.services.hotel')
    @endif
    <!-- only for gates -->
    @if($service == 4)
        @include('Organization::_components.layout.services.gate')
    @endif

    <!-- only for components -->
    @if($service == 5)
        @include('Organization::_components.layout.services.component')
    @endif


    <!-- only for events -->
    @if($service == 6)
        @include('Organization::_components.layout.services.event')
    @endif


    <!-- only for finance -->
    @if($service == 7)
        @include('Organization::_components.layout.services.finance')
    @endif


    <!-- only for hr -->
    @if($service == 8)
        @include('Organization::_components.layout.services.hr')
    @endif


    <!-- only for laundries -->
    @if($service == 9)
        @include('Organization::_components.layout.services.laundry')
    @endif
    <!-- only for rent -->
    @if($service == 10)
        @include('Organization::_components.layout.services.rent')
    @endif

    <!-- only for sports activities -->
    @if($service == 11)
        @include('Organization::_components.layout.services.activity')
    @endif
@endforeach
