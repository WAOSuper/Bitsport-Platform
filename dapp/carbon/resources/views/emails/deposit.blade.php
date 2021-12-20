<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BITSPORT | Deposit Confirmation</title>
</head>
<body>
<h2>Deposit Confirmation</h2>
<h3>
      	User {{ $user->first_name }} {{ $user->last_name }}
      	deposit ${{$deposit->amount}} {{ $deposit->coin_type }} to Bitsport
		Account: {{ $user->email }}
		Batch: {{ $deposit->address}}
		Compound: 0%.
		Referrers fee: $0

		if you need support please send us email support@bitsport.com, Also follow our social media network.
  </h3>


<p>Thanks & Regards</p>
<b><img src="{{url('')}}/assets/images/coins/bitplaywide.png" alt="" style="width: 210px;" /> </b>
</body>
</html>
