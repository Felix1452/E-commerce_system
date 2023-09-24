@section('head')
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
@endsection

@extends('main')

@section('content')

        @include('admin.alert')

        <span>Trạng thái: </span>
            <div id="desName" value="">
                
            </div>
            <div id="status" value="">
                
            </div>
@endsection

@section('foot')
<script>
    var desName = document.getElementById("desName").value;
    var x = document.getElementById("status").value;
    var strJSON = JSON.stringify(x);
    console.log(strJSON);



    message = new Paho.MQTT.Message(strJSON);
    message.destinationName = desName;
    client.send(message);

    client = new Paho.MQTT.Client("broker.hivemq.com", Number(8000), "pVlute-00");

    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    client.connect({ onSuccess: onConnect });

    function onConnect() {
        console.log("onConnect");
        client.subscribe("PVLUTE/KT/DGT");
    }

    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    }

    function onMessageArrived(message) {
        console.log("onMessageArrived:" + message.payloadString);
        document.getElementById("trangthai").innerHTML = message.payloadString;
    }
</script>

@endsection

    

