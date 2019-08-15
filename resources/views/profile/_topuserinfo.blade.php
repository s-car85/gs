<div class="heading-wrapper-inline">
    <div class="col-xs-9 col-sm-11 heading-prepend">
        <div class="row">
            <div class="col-sm-12 col-md-4 profile-data">
                <img src="{{ asset('img/user.png') }}" alt="" class="userimage">
                <h1>{{ $user->name }} {{ $user->surname }}</h1>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="row">
                    <div class="col-sm-12 col-md-4 profile-data-item">
                        <span>Email adresa</span><br>
                        <a href="mailto:{{ $user->email }}" title="">{{ $user->email }}</a>
                    </div>
                    <div class="col-sm-12 col-md-4 profile-data-item">
                        <span>Telefon</span><br>
                        {{ $user->phone }}
                    </div>
                    <div class="col-sm-12 col-md-4 profile-data-item">
                        <span>Adresa</span><br>
                        {{ $user->address }},
                        {{ $user->zip }} {{ $user->city }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clarfix"></div>