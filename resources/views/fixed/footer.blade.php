<!-- Footer -->
<footer class="py-5 footer">
    <div class="container">
        <p class="m-0 text-center"><a href="{{route('autor')}}">Copyright &copy; KAFICOMIKA 2021</a></p>
    </div>
    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <div class="modal-content">
                <div class="modal-c-tabs">
                    <ul class="nav nav-tabs md-tabs tabs-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fas fa-user mr-1"></i>
                                Prijava</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fas fa-user-plus mr-1"></i>
                                Registracija</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <!--------------------------------------- LOG IN PANEL ----------------------------------------->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                            <!--------------------------------------- LOG IN FORMA ----------------------------------------->
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="modal-body mb-1">
                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-envelope prefix"></i>
                                        <input name="uEmail" type="email" id="modalLRInput10" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">Tvoj email</label>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <input name="uPass" type="password" id="modalLRInput11" class="form-control form-control-sm validate">
                                        <label data-error="wrong" data-success="right" for="modalLRInput11">Tvoja lozinka</label>
                                    </div>
                                    @if($errors->any())
                                        <div class="alert alert-danger my-3">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}<br/>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="text-center mt-2">
                                        <input type="hidden" name="prijavljen">
                                        <button class="btn btn-outline-secondary">Prijavi se</button>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="options text-center text-md-right mt-1">
                                    <p>Zaboravio/la si <a href="?page=Kontakt" class="crveni-text">lozinku?</a></p>
                                </div>
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Zatvori</button>
                            </div>
                        </div>

                        <!--------------------------------------- REGISTRACIJA PANEL ----------------------------------------->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">

                            <!--------------------------------------- REGISTRACIJA FORMA ----------------------------------------->
                            <form action="{{route('register')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-envelope prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput12">Tvoj email</label>
                                        <input name="uEmail" type="email" id="mailRegistracija modalLRInput12" class="form-control form-control-sm validate">
                                        <small id="greskaMail" class="greska form-text"></small>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput13">Tvoja lozinka</label>
                                        <input name="uPass" type="password" id="passRegistracija modalLRInput13" class="form-control form-control-sm validate">
                                        <small id="passwordHelpBlock" class="form-text text-muted">Lozinka mora imati bar 4 karaktera i broj.</small>
                                        <small id="greskaPass" class="greska form-text"></small>
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <i class="fas fa-lock prefix"></i>
                                        <label data-error="wrong" data-success="right" for="modalLRInput14">Tvoje korisničko ime</label>
                                        <input name="uName" type="text" id="userRegistracija modalLRInput14" class="form-control form-control-sm validate">
                                        <small id="greskaUsr" class="greska form-text"></small>
                                    </div>

                                    @if($errors->any())
                                        <div class="alert alert-danger my-3">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}<br/>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="text-center form-sm mt-2">
                                        <input type="hidden" name="registrovanje">
                                        <input type="submit" class="btn btn-outline-secondary" value="Registruj se">
                                    </div>

                                </div>
                            </form>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Zatvori</button>
                            </div>
                        </div>
                        <!--------------------------------------- REGISTRACIJA KRAJ PANELA ----------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cleaner">

    </div>
    <!-- /.container -->
</footer>
