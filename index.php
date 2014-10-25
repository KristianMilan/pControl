<!DOCTYPE html>
<html>

<head>
    <title>pControl</title>
    <meta name="author" content="Alufers">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
    <meta http-equiv="content-style-type" content="text/css">
    <meta http-equiv="expires" content="0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .full-size {
            width: 100%;
        }
    </style>
    <link rel="Stylesheet" type="text/css" href="css/semantic.min.css" />
    <script type="text/javascript" src="javascript/jquery-latest.min.js"></script>
    <script type="text/javascript" src="javascript/semantic.min.js"></script>
    <script src="javascript/pControl.js"></script>
	<script src="javascript/desktop.js"></script>
</head>

<body>
    <!-- Modals and other hidden things -->
    <!-- communication error modal -->
    <div class="ui modal communication-error-modal">
        <div class="header">
            Wystąpił błąd
        </div>
        <div class="content">
            <div class="left">
                <i class="ui massive warning icon"></i>
            </div>
            <div class="right">
                <p>Nie można nawiązać połączenia z serwerem.</p>
                <p>Problem może być spowodowany między innymi przez niepoprawną konfigurację bazy danych.</p>

            </div>
        </div>
        <div class="actions">

            <a class="ui blue button" href="?">Odśwież</a>
        </div>
    </div>
    <!-- END communication error modal -->
    <!-- shutdown confirm modal -->
    <div class="ui basic modal shutdown-modal">
        <div class="header">
            Na pewno chcesz wyłączyć urządzenie?
        </div>
        <div class="content">
            <div class="left">
                <i class="off icon"></i>
            </div>
            <div class="right">
                <p>Aby ponownie je uruchomić trzeba będzie włączyć i wyłączyć zasilanie!</p>
            </div>
        </div>
        <div class="actions">
            <div class="two fluid ui buttons">
                <div class="ui negative labeled icon button">
                    <i class="remove icon"></i> Nie
                </div>
                <div class="ui positive right labeled icon button">
                    Tak
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- END shutdown confirm modal -->

    <!-- reboot confirm modal -->
    <div class="ui basic modal reboot-modal">
        <div class="header">
            Na pewno chcesz uruchomić ponownie urządzenie?
        </div>
        <div class="content">
            <div class="left">
                <i class="refresh icon"></i>
            </div>
            <div class="right">
                <p>Zostaniesz wylogowany!</p>
            </div>
        </div>
        <div class="actions">
            <div class="two fluid ui buttons">
                <div class="ui negative labeled icon button">
                    <i class="remove icon"></i> Nie
                </div>
                <div class="ui positive right labeled icon button">
                    Tak
                    <i class="checkmark icon"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- END reboot confirm modal -->
    <!-- add device modal -->
    <div class="ui modal add-device-modal">
        <i class="close icon"></i>
        <div class="header">
            Dodaj urządzenie
        </div>
        <div class="content">
            <div class="ui form segment">

                <div class="field">
                    <label>Opis</label>
                    <input placeholder="Opis" type="text" class="add-device-modal-description">
                </div>
                <div class="field">
                    <label>Pin</label>
                    <input placeholder="Pin" type="number" class="add-device-modal-pin">
                </div>
                <div class="">
                    <label>Odwróć</label>
                    <input type="checkbox" class="add-device-modal-inverted">

                </div>

            </div>

        </div>
        <div class="actions">
            <div class="ui negative button">
                Anuluj
            </div>
            <div class="ui positive button">
                OK
            </div>
        </div>
    </div>
    <!-- END add device modal -->
	 <!-- add category modal -->
    <div class="ui modal add-category-modal">
        <i class="close icon"></i>
        <div class="header">
            Dodaj kategorię
        </div>
        <div class="content">
            <div class="ui form segment">

                <div class="field">
                    <label>Nazwa</label>
                    <input placeholder="Opis" type="text" class="add-category-modal-name">
                </div>
                <div class="field">
                    <label>Kolumna</label>
                    <select class="add-category-modal-column">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					</select>
                </div>
               

            </div>

        </div>
        <div class="actions">
            <div class="ui negative button">
                Anuluj
            </div>
            <div class="ui positive button">
                OK
            </div>
        </div>
    </div>
    <!-- END add category modal -->
    <!-- login modal -->
    <div class="ui modal login-modal">
        <div class="header">
            Zaloguj się
        </div>
        <div class="content">
            <div class="left">
                <i class="ui massive user icon"></i>
            </div>
            <div class="right">
                <p>Aby móc korzystać z panelu musisz się zalogować.</p>
                <div class="ui hidden red icon message login-please-fill">
                    <i class="pencil icon"></i>
                    <div class="content">
                        <div class="header">
                            Błąd!
                        </div>
                        <p>Proszę wypełnić wszystkie pola!</p>
                    </div>
                </div>

                <div class="ui hidden red icon message login-wrong-data">
                    <i class="warning icon"></i>
                    <div class="content">
                        <div class="header">
                            Błąd!
                        </div>
                        <p>Nazwa użytkownika lub hasło są nie poprawne!</p>
                    </div>
                </div>
                <!--Form start -->
                <div class="ui form">

                    <div class="field">

                        <div class="ui left labeled icon input">
                            <input type="text" placeholder="Nazwa użykownika" class="login-username">
                            <i class="user icon"></i>
                            <div class="ui corner label">
                                <i class="icon asterisk"></i>
                            </div>
                        </div>
                    </div>
                    <div class="field">

                        <div class="ui left labeled icon input">
                            <input type="password" placeholder="Hasło" class="login-password">
                            <i class="lock icon"></i>
                            <div class="ui corner label">
                                <i class="icon asterisk"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!--Form end -->
            </div>
        </div>
        <div class="actions">

            <div class="ui positive button login-submit" href="?">Zaloguj się</div>
        </div>
    </div>
    <!-- END login modal -->
    <!-- END Modals and other hidden things -->
    <div class="ui menu">
        <a class="active blue item shape-control" data-side=".manage">
            <i class="wrench icon"></i> Zarządzaj
        </a>
        <a class="blue item shape-control" data-side=".control">
            <i class="dashboard icon"></i> Steruj
        </a>
        <a class="red item shape-control" data-side=".plan">
            <i class="calendar icon"></i> Planuj
        </a>
        <a class="teal item shape-control" data-side=".connect">
            <i class="wrench icon"></i> Podłączaj
        </a>
        <div class="right menu">
		<div class="temp item"><i class="ui loading icon"></i></div>
		<div class="ip item"><i class="ui loading icon"></i></div>
            <div class="item set-username">
                Ja
            </div>
            <div class="ui pointing dropdown link item">
                <i class="icon user"></i> <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="green item"><i class="setting icon"></i>Zmień hasło</a>
                    <a class="red item logout"><i class="off icon"></i>Wyloguj</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ui shape">
        <div class="sides">
            <div class="active side full-size manage">
                <div class="ui two column grid">
                    <div class="column">
                        <div class="ui red segment">
                            <b>Zasilanie</b>
                            <br>
                            <br>
                            <div class="ui 2 fluid labeled icon buttons">
                                <div class="ui button shutdown"><i class="off icon"></i>Wyłącz
                                    <br>&nbsp;</div>
                                <div class="ui button reboot"><i class="refresh icon"></i>Uruchom ponownie</div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui blue segment">
                            <b>Konsola</b>
                            <div class="ui form">
                                <div class="field">

                                    <textarea class="console"></textarea>
                                </div>
                                <div class="ui action input">
                                    <input type="text" placeholder="Wpisz komendę" class="console-input">
                                    <div class="ui icon button console-submit"><i class="terminal icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="full-size side control">

                <div class="switch-container"></div>




            </div>

            <div class="side full-size plan">This is yet another side</div>
            <div class="side full-size connect">
                <div class="ui two column grid">
                    <div class="column">
                        <table class="ui table segment">
                            <thead>
                                <tr>
                                    <th colspan="4" class="ui center aligned header">
                                        Urządzenia
                                    </th>
                                </tr>
                                <tr>
                                    <th>Opis</th>
                                    <th>Pin</th>
                                    <th>Stan</th>
                                    <th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody class="connect-table">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        <div class="ui blue labeled icon button add-device"><i class="hdd icon"></i> Dodaj urządzenie</div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="column">
                        <table class="ui table segment">
                            <thead>
                                <tr>
                                    <th colspan="3" class="ui center aligned header">
                                        Kategorie
                                    </th>
                                </tr>
                                <tr>
                                    <th>Nazwa</th>
									<th>Kolumna</th>
									<th>Akcja</th>
                                </tr>
                            </thead>
                            <tbody class="category-table">
							
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">
                                        <div class="ui teal labeled icon button add-category"><i class="folder icon"></i> Dodaj kategorię</div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>




            </div>
        </div>
    </div>
</body>

</html>