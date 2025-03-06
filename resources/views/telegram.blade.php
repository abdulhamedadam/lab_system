@extends('dashbord.layouts.master')
@section('content')
    <!-- resources/views/telegram.blade.php -->


    <h2 class="text-center">Send Message to Telegram</h2>
   <div class="card" style="padding: 40px">
       <form action="{{ route('admin.telegram.send') }}" method="POST">
           @csrf
           <div class="mb-3">
               <label for="message" class="form-label">Message:</label>
               <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
           </div>
           <button type="submit" class="btn btn-primary">Send</button>
       </form>
   </div>




@endsection
