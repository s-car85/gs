@extends('layout')

@section('title', 'Izmena lozinke')

@section('content')


    <section class="products-section">
        <div class="container">

            @include('profile._topuserinfo')

            <div class="row products-outer">

                @include('profile._usernav')


                <div class="userpanelwrap">

                    <div class="profile-section profile-user-details col-xs-12">

                        <h3>PROMENA LOZINKE</h3>


                        @if($errors->any())
                            <ul class="alert-danger list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>* {{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($user, ['method' =>  'put']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="password" class="control-label">Nova lozinka*</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="password_confirmation" class="control-label">Ponovite lozinku*</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="main-btn">
                                    Sačuvaj
                                </button>
                            </div>

                        {!! Form::close() !!}


                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.sub-menu ul').hide();
        $(".sub-menu a").click(function () {
            $(this).parent(".sub-menu").children("ul").slideToggle("100");
            $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
        });
    </script>
@endsection