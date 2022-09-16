@include('header')

        <div class="container">

            <!-- main content goes here -->
            @foreach ($jobs as $index => $job)
            <div class="accordion" id="accordion{{ $index }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                            {{ $job->job }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse show" aria-labelledby="heading{{ $index }}"
                        data-bs-parent="#accordion{{ $index }}">

                        <div class="accordion-body">
                            @foreach ($candidates as $cidx => $candidate)
                            @if ($candidate->job_id == $job->id)
                            <div class="accordion" id="accordion{{ $candidate->name }}">
                                <div class="accordion-item">
                                  <div class="accordion-header">
                                    <button class="accordion-button" data-bs-toggle="collapse" data-parent="#accordion{{ $index }}" href="#collapseInner{{ $candidate->name }}">
                                      {{ $candidate->name }} 
                                      @php $sum = 0 @endphp
                                      @foreach ($skills as $skill)
                                        @if (($skill->candidate_id === $candidate->id) 
                                            && ($skill->job_id == $job->id)) 
                                              @php 
                                                $sum += $skill->getLevel->factor
                                              @endphp
                                        @endif
                                      @endforeach
                                      <b>{{ $sum }}</b>
                                    </button>
                                  </div>
                                  <div id="collapseInner{{ $candidate->name }}" class="accordion-body collapse in">
                                    <div class="accordion-body">
                                      <p>E-mail: {{ $candidate->email }}</p>
                                      <p>Phone Number: {{ $candidate->phone }}</p>
                                      <h6>Competences Levels</h6>
                                      <div class="grid">
                                        @foreach ($skills as $skill)
                                        @if (($skill->candidate_id === $candidate->id) 
                                            && ($skill->job_id == $job->id)) 
                                              <div>
                                                <b>{{ str_replace('_', ' ', $skill->competence) }}</b>
                                                <p>{{ $skill->level }}</p>
                                            </div>
                                        @endif
                                      @endforeach
                                        <div>
                                            <b>HTML</b>
                                            <p>No knowledge</p>
                                        </div>
                                        <div>
                                            <b>CSS</b>
                                            <p>Beginner</p>
                                        </div>

                                      </div>
                                      <div class="footer">Registration Time: {{ $job->candidate[0]->created_at }}</div>
                                    </div>
                                  </div>
                                </div>
                              </div>  
                              @endif        
                       
                            @endforeach
                          </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </main>

@include('footer')