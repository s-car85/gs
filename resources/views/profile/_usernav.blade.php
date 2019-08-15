<div class="categories-list">
    <nav>
        <ul>
            <li class="sub-menu category-item">
                <a href="javascript:void(0)" class="d-block d-md-none d-sm-flex align-items-center ">
                    <span class="w-100">MENI</span>
                    <i class='fa fa-caret-down right'></i>
                </a>
                <ul>

                    <li class="category-item">
                        <a class="category-link {{ request()->segment(1) == 'profil' ? 'active' : '' }}" href="{{ url('profil') }}">
                            KORISNIČKI PODACI
                        </a>
                    </li>

                    <li class="category-item">
                        <a class="category-link {{ request()->segment(1) == 'izmena-podataka' ? 'active' : '' }}" href="{{ url('izmena-podataka') }}">
                            IZMENA PODATAKA
                        </a>
                    </li>

                    <li class="category-item">
                        <a class="category-link {{ request()->segment(1) == 'izmena-lozinke' ? 'active' : '' }}" href="{{ url('izmena-lozinke') }}">
                            IZMENA LOZINKE
                        </a>
                    </li>

                    <li class="category-item">
                        <a class="category-link {{ request()->segment(1) == 'status-porudzbenica' ? 'active' : '' }}" href="{{ url('status-porudzbenica') }}">
                            STATUS PORUDŽBENICA
                        </a>
                    </li>


                </ul>
            </li>
        </ul>
    </nav>
</div>