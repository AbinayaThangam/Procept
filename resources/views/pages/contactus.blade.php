@extends('layouts.home')
@section('content')
@include('layouts.nav')
<section class="contact-form my-5">

    <div class="container my-5">
        <div class="card-header">
            <h4 class="mb-0"><span class="allevents-title">Contact</span></h4>
        </div>
        <button class="all-events-list mt-5">
            <a href="/"> Home </a> <i class='fas'>&#xf0da; </i> Contact
        </button>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-7">

                {{-- Display success message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @foreach ($contactInfoDetails as $content)
                    @if ($content->region == App\Constants\AppConstants::CONTENT)
                        <h2 class="contact-title">{{ $content->title }}</h2>
                        <p>{!! preg_replace('/\[[^\]]+\]/', '', $content->body) !!}</p>
                    @endif
                @endforeach
                <div class="contact-us">
                    <form action="{{ route('contact.create') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control contact-input" id="name" name="name" required>
                            </div>
                            <div class="col-md-12">
                                <label for="email">Your E-mail Address</label>
                                <input type="email" class="form-control contact-input" id="email" name="email" required>
                            </div>
                            <div class="col-md-12">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control contact-input" id="subject" name="subject"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label for="message">Message</label>
                                <textarea class="form-control contact-input" id="message" name="message" rows="4"
                                    required></textarea>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn event-filter-btn btn-secondary">SEND
                                            MESSAGE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-lg-5 contact-details">
                @foreach ($contactInfoDetails as $content)
                    @if ($content->region == App\Constants\AppConstants::RIGHTSIDEBAR)
                        <h2 class="contact-title">{{ $content->title }}</h2>
                        <p>{!! preg_replace('/\[[^\]]+\]/', '', $content->body) !!}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')


@endsection
