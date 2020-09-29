<?php
$messages = \App\VendorMessage::where('vendor_id', $vendordetails->id)->get(); ?>

<div>
    <form action="{{ route('admin.vendor-message') }}" method="post" id="message_form">
        @csrf
        <div>
            <label> <strong>Message</strong> </label>
            <textarea name="message" id="message" cols="30" rows="10" style="width:100%"></textarea>
        </div>
    </form>
    <div>
        <input type="submit" value="Send Message" class="btn btn-primary" onclick="sendMsg()">
    </div>
</div>
<style>
    .card-alert {

        background-color: #f55a4e;
        color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4)
    }

    .card-success {

        background-color: #f55a4e;
        color: #ffffff;
        border-radius: 3px;
        box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4)
    }

    .text-white {
        color: #ffffff;
    }

</style>
@foreach ($messages as $message)
    <br>
    <div class="card {{$message->?"card-alert":"card-success"}}">
        {{$message->message}}
    </div>
    <br>

@endforeach
