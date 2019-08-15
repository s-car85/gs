<h1>Kontakt sa sajta:</h1><br>
Ime:{{ $request->name }} <br><br>
Prezime:{{ $request->lastname }} <br><br>
E-mail:{{ $request->email }} <br><br>
Tema:{{ $request->subject }} <br><br>
Pitanje:{{ nl2br($request->message) }} <br>

