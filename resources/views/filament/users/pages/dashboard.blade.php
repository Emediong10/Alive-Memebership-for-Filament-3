
<x-filament-panels::page>
    @php
        $licence = App\Models\User::where(['course_of_study' => null, 'id' => auth()->user()->id])->first();
        $user = auth()->user();
        //dd($licence);
    @endphp

    @if (!$user->hasRole('admin'))
        <div>
            <strong>
                HELLO: {{ $user->name }}
            </strong>
        </div>
        {{-- {{ dd($licence) }} --}}
        @if ($licence)
            <div style="font-size:22px; font-weight:bold">
                <h5>Notice! Notice!! Notice!!!</h5>
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
    </style>

</x-filament-panels::page>
