<li class="">
    <a href="{{ route('home') }}">
        <i class="fal fa-tachometer-alt"></i>
        <span class="nav-link-text" >Inicio</span>
    </a>
</li>

<li class="">
    <a title="Application Intel" data-filter-tags="application intel">
        <i class="fal fa-cog"></i>
        <span class="nav-link-text" >Solicitudes</span>
    </a>
    <ul>

        <li>
            <a href="{{ route('solicitudes.index', 1) }}" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><i class="fal fa-lock-alt"></i> Recibidas</span>
            </a>
        </li>

        <li>
            <a href="{{ route('solicitudes.index', 2) }}" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><i class="fal fa-lock-alt"></i> Proceso</span>
            </a>
        </li>

        <li>
            <a href="{{ route('solicitudes.index', 4) }}" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><i class="fal fa-lock-alt"></i> Completadas</span>
            </a>
        </li>
        <li>
            <a href="{{ route('solicitudes.index', 3) }}" title="Analytics Dashboard" data-filter-tags="application intel analytics dashboard">
                <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><i class="fal fa-lock-alt"></i> Canceladas</span>
            </a>
        </li>
    </ul>


</li>
