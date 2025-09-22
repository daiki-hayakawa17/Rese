<p>{{ $reservation->user->name }}様</p>

<p>以下の内容でご予約を承っております。</p>

<ul>
    <li>店舗名:{{ $reservation->shop->name }}</li>
    <li>日時:{{ $reservation->date }} {{ $reservation->time }}</li>
    <li>人数:{{ $reservation->number }}人</li>
</ul>

<p>ご来店をお待ちしております。</p>