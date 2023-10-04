<h1>Aduan telah di respon</h1>

Hallo {{ $user->name }} <br>
Kamu bisa respon kembali dengan mengklik link dibawah ini : <br>
<a href="{{ route('formJawab', ['token' => $token, 'aduan' => $aduan]) }}">Jawab kembali</a>
