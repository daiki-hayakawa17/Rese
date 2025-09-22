<p>{{ $reservation->user->name }}様</p>

<hr>
<p> 【予約情報】
<p>店舗名:{{ $reservation->shop->name }}</p>
<p>日時:{{ $reservation->date }} {{ $reservation->time }}</p>
<p>人数:{{ $reservation->number }}</p>
<p>利用者:{{ $reservation->user->name }}</p>

<hr>
<p>【お知らせ】</p>
<p>{{ $bodyMessage }}</p>