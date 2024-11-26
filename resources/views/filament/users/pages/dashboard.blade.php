
<x-filament-panels::page>
    @php
        $licence = App\Models\User::where(['course_of_study' => null, 'id' => auth()->user()->id])->first();
        $user = auth()->user();
        //dd($licence);
    @endphp

    @if (!$user->hasRole('admin'))
        <div>
            <strong>
                Welcome: {{ $user->name }}
            </strong>
        </div>
        {{-- {{ dd($licence) }} --}}
        @if ($licence)
            <div style="font-size:22px; font-weight:bold">
                {{-- <h5>{{ $comment }}</h5> --}}
            </div>
            <div class="center" style="font-size:22px; font-weight:bold">
                <p>If you are not sure of your spiritual gifts, click below to complete the Spiritual Gifts test. Take
                    note of your first 3 Spiritual gifts.</p>
            </div>
            <div class="alert-info center" style="font-size:22px; font-weight:bold">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <a href="http://spiritualgiftstest.com/spiritual-gifts/" target='blank'>Click here to take Your Spiritual
                    Gift Test</a>
            </div>

            <p style="font-size:22px; font-weight:bold">Return here to complete the registration process.</p>

            <div class="alert center" style="font-size:22px; font-weight:bold">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <a href="{{ url('users/profile-update') }}">Click Here to update Your Profile</a>
            </div>
        @else

        <div class="container-fluid pb-video-container">
            <div class="col-md-10 col-md-offset-1">
                <h3 class="text-center">Sample Video Gallery</h3>
                <div class="row pb-row">

                    <div class="col-md-3 pb-video">
                        <iframe class="pb-video-frame" width="100%" height="230" src="https://www.youtube.com/embed/h3kRIxLruDs?ecver=" frameborder="0" allowfullscreen></iframe>
                        <label class="form-control label-warning text-center">ALIVE</label>
                    </div>
                </div>
            </div>
        </div>






        @endif
    @endif

    @livewire('notifications')
    {{--
    <x-filament::widgets :widgets="$this->getWidgets()" :columns="$this->getColumns()" /> --}}
    <style>
        /* The alert message box */
        .alert {
            padding: 20px;
            background-color: rgb(13, 53, 16);
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        .alert-info {
            padding: 20px;
            background-color: rgb(11, 28, 53);
            /* Red */
            color: white;
            margin-bottom: 15px;
        }

        /* The close button */
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
            color: black;
        }

    .pb-video-container {
        padding-top: 20px;
        background: #bdc3c7;
        font-family: Lato;
    }

    .pb-video {
        border: 1px solid #e6e6e6;
        padding: 5px;
    }

        .pb-video:hover {
            background: #2c3e50;
        }

    .pb-video-frame {
        transition: width 2s, height 2s;
    }

        .pb-video-frame:hover {
            height: 300px;
        }

    .pb-row {
        margin-bottom: 10px;
    }
</style>

</x-filament-panels::page>
