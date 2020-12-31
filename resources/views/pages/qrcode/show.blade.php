<h2 style="margin-bottom: 60px; text-align: center">ChargeMOD QR Codes</h2>
<div style="text-align: center">
    @foreach($collection as $collections)
            <img src="{{ url('storage/qrcodes/' . $collections['qr_code'] . '.png') }}">
    @endforeach
</div>

