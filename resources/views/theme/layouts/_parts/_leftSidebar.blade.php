<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin:home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>{{-- <span class="badge rounded-pill bg-warning float-end">04</span> --}}
                        <span key="t-dashboards">{{ __('navbar.dashboard') }}</span>
                    </a>
                </li>

                @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                    <li class="menu-title" key="t-apps">Gestion commercial</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-sell_invoices">{{ __('Gestion de ventes') }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li>
                                <a href="{{ route('commercial:estimates.index') }}" key="t-factures-devis">
                                    <i class="bx bx-file-blank"></i><span
                                        class="badge rounded-pill bg-warning float-end">{{ $estimates_not_send }}</span>

                                    {{ __('navbar.estimates') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:invoices.index') }}" key="t-invoice-list">
                                    <i class="bx bx-food-menu"></i>
                                    {{ __('navbar.invoices') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:invoices.index.avoir') }}" key="t-avoir-list">
                                    <i class="bx bx-food-menu"></i>
                                    Avoirs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:bills.index') }}" key="t-factures-list">
                                    <i class="bx bx-money"></i>
                                    Règlements
                                </a>
                            </li>



                            <li>
                                <a href="{{ route('admin:clients.index') }}" key="t-clients">
                                    <i class="bx bx-user"></i>
                                    {{ __('navbar.clients') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('commercial:reports.index') }}" key="t-reports">
                                    <i class="bx bx-line-chart"></i>
                                    Rapport Clients
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-buy-achat">{{ __("Gestion d'achat") }}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li>
                                <a href="{{ route('buy:estimates.index') }}" key="t-buy-factures-devis">
                                    <i class="bx bx-file-blank"></i>

                                    {{ __('Devis') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buy:invoices.index') }}" key="t-buy-invoice-list">
                                    <i class="bx bx-food-menu"></i>
                                    {{ __('Factures') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('buy:bcommandes.index') }}" key="t-bc-list">
                                    <i class="bx bx-file"></i>
                                    {{ __('navbar.bc') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('buy:providers.index') }}" key="t-buy-providers">
                                    <i class="bx bx-user"></i>
                                    Fournisseurs
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-expenses">{{ __('Gestion Dépenses') }}</span>

                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li>
                                <a href="{{ route('expense:automations.index') }}" key="t-expenses">
                                    <i class="bx bx-file-blank"></i>

                                    {{ __('Automatisations') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('expense:invoices.index') }}" key="t-products-list">
                                    <i class="bx bx-file"></i>
                                    Dépenses
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-line-chart"></i>
                            <span key="t-stat-taxes">{{ __('Statistiques') }}</span>

                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li>
                                <a href="{{ route('commercial:taxes') }}" key="t-taxes-list">
                                    <i class="bx bx-file"></i>
                                    Taxes
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('commercial:sells') }}" key="t-sells-list">
                                    <i class="bx bx-file"></i>
                                    Ventes
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="menu-title" key="t-apps">Catalogue</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-catalogs">Catalogue</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('commercial:categories') }}" key="t-category-list">
                                    <i class="bx bx-file"></i>
                                    Catégories
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:brands') }}" key="t-brands-list">
                                    <i class="bx bx-file"></i>
                                    Marques
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:products') }}" key="t-products-list">
                                    <i class="bx bx-file"></i>
                                    Produits
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-title" key="t-stocks">Stock</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-grid-alt"></i>
                            <span key="t-stocks">Stock</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('commercial:adjustments') }}" key="t-adjustments-list">
                                    <i class="bx bx-file"></i>
                                    ajustements
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:warehouses') }}" key="t-warehouses-list">
                                    <i class="bx bx-file"></i>
                                    Entrepôts
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commercial:cities') }}" key="t-products-list">
                                    <i class="bx bx-file"></i>
                                    Ville
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="menu-title" key="t-components">{{ __('Paramètres') }}</li>

                <li>
                    <a href="{{ route('admin:admins') }}" class="waves-effect">
                        {{-- <span class="badge rounded-pill bg-success float-end" key="t-new">New</span> --}}
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">Utilisateurs</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin:settings.index') }}" class="waves-effect">
                        {{-- <span class="badge rounded-pill bg-success float-end" key="t-new">New</span> --}}
                        <i class="bx bx-wrench"></i>
                        <span key="t-settings">Paramètres</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!---------Elmarzougui Abdelghafour------->
