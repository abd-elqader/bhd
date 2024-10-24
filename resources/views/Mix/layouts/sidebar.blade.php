<ul>
    @if (tenant())

        @include('Mix.layouts.SidebarComponents.visit_website')
        @include('Mix.layouts.SidebarComponents.dashboard')
        @include('Mix.layouts.SidebarComponents.public_settings')

        @include('Mix.layouts.SidebarComponents.themes')
        @include('Mix.layouts.SidebarComponents.more')
        @include('Mix.layouts.SidebarComponents.renew_packages')
        @include('Mix.layouts.SidebarComponents.categories')
        @include('Mix.layouts.SidebarComponents.products')
        @include('Mix.layouts.SidebarComponents.orders')
        @include('Mix.layouts.SidebarComponents.deliveries')
        @include('Mix.layouts.SidebarComponents.payments')
        @include('Mix.layouts.SidebarComponents.DeliveryCompany')
        @include('Mix.layouts.SidebarComponents.settings')
        @role('Admin')
            @include('Mix.layouts.SidebarComponents.roles')
            @include('Mix.layouts.SidebarComponents.admins')
            @include('Mix.layouts.SidebarComponents.agents')
        @endrole
        @include('Mix.layouts.SidebarComponents.clients')
        @include('Mix.layouts.SidebarComponents.reports')
        @include('Mix.layouts.SidebarComponents.branches')
        @include('Mix.layouts.SidebarComponents.countries')
        @include('Mix.layouts.SidebarComponents.lang')

    @else

        @include('Mix.layouts.SidebarComponents.visit_website')
        @include('Mix.layouts.SidebarComponents.dashboard')
        @include('Mix.layouts.SidebarComponents.tenants')
        @include('Mix.layouts.SidebarComponents.default_themes')
        @include('Mix.layouts.SidebarComponents.payments')
        @include('Mix.layouts.SidebarComponents.settings')
        @include('Mix.layouts.SidebarComponents.packages')
        @include('Mix.layouts.SidebarComponents.deliveries')
        @include('Mix.layouts.SidebarComponents.blogs')
        @include('Mix.layouts.SidebarComponents.stores')
        @include('Mix.layouts.SidebarComponents.more')
        @include('Mix.layouts.SidebarComponents.faq')
        @include('Mix.layouts.SidebarComponents.contact')
        @role('Admin')
        @include('Mix.layouts.SidebarComponents.roles')
        @include('Mix.layouts.SidebarComponents.admins')
        @include('Mix.layouts.SidebarComponents.agents')
        @include('Mix.layouts.SidebarComponents.services')
        @endrole
        @include('Mix.layouts.SidebarComponents.lang')


    @endif

</ul>
