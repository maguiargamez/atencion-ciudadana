<li class="">
    <a href="{{ route('home') }}">
        <i class="fal fa-tachometer-alt"></i>
        <span class="nav-link-text" >Inicio</span>
    </a>
</li>


<li class="">
    <a href="#" title="Application Intel" data-filter-tags="application intel">
        <i class="fal fa-cog"></i>
        <span class="nav-link-text" >Configuración</span>
    </a>
    <ul>

        <li>
            <a href="{{ route('catalogos.index') }}" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">

                <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><i class="fal fa-lock-alt"></i> Catálogos</span>
            </a>
        </li>

        <li>
            <a href="{{ route('cuentas-usuario.index') }}" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">

                <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><i class="fal fa-lock-alt"></i> Cuentas de usuario</span>
            </a>
        </li>
    </ul>


</li>


