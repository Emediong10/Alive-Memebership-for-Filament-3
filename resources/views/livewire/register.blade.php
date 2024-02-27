
 <div>
   {{-- wizard Starts--}}
   <div class="container">
        @if(!empty($successMessage))
            <div class="alert alert-success">
                {{ $successMessage }}
            </div>
        @endif
        @if(!empty($successMsg))
            <div class="alert alert-success">
                {{ $successMsg }}
            </div>
        @endif
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @elseif (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
       @endif
      <div class="stepwizard mt-5">
            <div class="stepwizard-row setup-panel">
                @php
                    $first_counter = 1;
                    $second_counter = 1;
                @endphp
                @if($currentStep != 4)
                 <div class="stepwizard-step">
                    <a href="#step_1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}"> <span class="fw-bold" style="font-size: 15px">1</span></a>
                    <p class="text-capitalize">BIO Data</p>
                </div>
               <div class="stepwizard-step">
                    <a href="#step_1" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}"> <span class="fw-bold" style="font-size: 15px">2</span></a>
                    <p class="text-capitalize">Eligibility Questions</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step_1" type="button" class="btn btn-circle  {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}"> <span class="fw-bold" style="font-size: 15px">3</span></a>
                    <p class="text-capitalize">Final submission</p>
                </div>
                @endif
              </div>
        </div>
        <div class="setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step_1">
          <div class="col-xl-12">
            <h3 class="text-center mt-5 mb-5">Bio Data</h3>
            <h3> Step 1</h3>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="title">First Name:</label>
                        <input type="text" wire:model="firstname" class="form-control" id="firstName">
                        @error('firstname') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">last Name:</label>
                        <input type="text" wire:model="lastname" class="form-control" id="lastName">
                        @error('lastname') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Phone:</label>
                        <input type="text" wire:model="phone" class="form-control" />
                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group row">
                       <label for="gender">Gender:</label>
                        <label class="radio-inline">
                            <input class="" type="radio" id="male" wire:model="gender" name="gender" value="male">
                            Male
                        </label>
                            <label class="radio-inline">
                            <input class="" type="radio" id="female" wire:model="gender" name="gender" value="female">
                           Female
                        </label> <br>
                        @error('gender') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="title">Middle Name:</label>
                        <input type="text" wire:model="middlename" class="form-control" id="middleName">
                        @error('middlename') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Date of Birth:</label>
                        <input type="date" wire:model="dob" class="form-control" id="dob">
                        @error('dob') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Email:</label>
                        <input type="email" wire:model="email" class="form-control" id="email" />
                        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="detail">Select Your Chapter:</label>
                        <select name="chapter" class="form-control" wire:model="chapter">
                        <option value="">Select Your Chapter</option>
                          @foreach($chapters as $chpt)
                          <option value="{{$chpt->id}}">{{$chpt->name}}</option>
                          @endforeach
                        </select>
                        @error('chapter') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>

              <div class="text-right mt-4 mb-5">
                 <button type="button" class="btn btn-lg btn-primary nextBtn" wire:click="firstStepSubmit">Next</button>
             </div>
             
           </div>
        </div>

        <div class="setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step_2">
            <div class="col-xs-12">
                <h3 class="text-center mt-5 mb-5">Eligibility Questions</h3>
                <h3>Step 2</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <p>I personally do active outreach monthly (not just church work):</p>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="monthly_outreach" value="yes">Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="monthly_outreach" value="no">No
                              </label> <br>
                            @error('monthly_outreach') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <p>I am a graduate or a Professional:</p>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="professional" value="yes">Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="professional" value="no">No
                              </label> <br>
                              @error('professional') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label> I desire to support ALIVE-Nigeria ministry with at least monthly</label>
                            <select class="form-select" wire:model="will_support">
                                <option value="">Select Option</option>
                                <option value="i don't want to support">I don't want to support AliveNG</option>
                                <option value="1k-5k">1k - 5k</option>
                                <option value="6k-9k">6k - 9k</option>
                                <option value="10k">10k above</option>
                             </select>
                             @error('will_support') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <p>I strive to live out our high Christian standard as taught by the Bible and SOP:</p>
                              <label class="radio-inline">
                                <input type="radio" class=""   wire:model="christian_standard" value="yes">Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="christian_standard" value="no">No
                              </label> <br>
                              @error('christian_standard') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <p>I have attended an ALIVE mission at least once:</p>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="attended_mission" value="yes">Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="attended_mission" value="no">No
                              </label> <br>
                              @error('attended_mission') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                     </div>
                </div>

                <div class="col-md-12 text-right mb-5 mt-3">
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                </div>
                 
            </div>
        </div>
        <div class="setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step_3">
            <div class="col-xs-12">
                <h3 class="text-center mt-5 mb-5">Final submission</h3>
                <h3>Step 3</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <p>Do you intend to support the ministry of ALIVE Nigeria on a monthly basis?:</p>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="monthly_support" value="yes"> Yes
                              </label>
                              <label class="radio-inline">
                                <input type="radio" class="" wire:model="monthly_support" value="No"> No
                              </label> <br>
                              @error('monthly_support') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        @if($monthly_support == 'yes')
                        <div class="form-group">
                        <label for="">Specify Amount you intend to Support Alive Nigeria with</label>
                        <input type="number" placeholder="Specify Amount in Naira" class="form-control" wire:model="monthly_amount" required></textarea>
                        @error('monthly_amount') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
        
                        <div class="form-group">
                            <label for="">Currency</label>
                            <select class="form-control" name="currency" wire:model="currency" required>
                                <option value="">Select Currency</option>
                                <option value="NGN">Naira</option>
                                <option value="USD">United States Dollars</option>
                            </select>
                        @error('currency') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                        @if ($monthly_amount >='1000')
                        
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="password">Create Password:</label>
                                <input type="password" id="password" wire:model="password" class="form-control" placeholder="Create a password">
                                @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" id="password_confirm" wire:model="confirm_password" class="form-control" placeholder="Confirm your password">
                                @error('confirm_password') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                      
                       @endif
                        @endif
                        
                      </div>
                    
                </div>
                <div class="col-md-12 text-right mb-5 mt-3">
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
                    <button class="btn btn-success btn-lg pull-right" wire:click="thirdStepSubmit" type="button">Submit!</button>
                </div>
          </div>
    </div>
    
    <div class="setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step_4">
    @if($will_support == '1k-5k' && $monthly_amount <= '1000')
    <div class="text-center mt-5 mb-5">
        <a href="{{ url('registration') }}" class="btn btn-success btn-lg"> Go back</a>
   </div>
    @else
    <div class="text-center mt-5 mb-5">
           <a href="{{ url('admin/login') }}" class="btn btn-success btn-lg">Proceed To Sign-in</a>
      </div>
    
    @endif


    
    </div>
   {{-- wizard Ends --}}

</div>




  


