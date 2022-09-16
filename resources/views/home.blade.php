@include('header')

        <div class="container">

            <!-- main content goes here -->
            <div class="accordion" id="accordionExample">
                @if (session('status') === 'success')
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>Ты успешно отправил заявку</p>
                        <hr>
                    </div>
                @endif
                @if (session('status') === 'updated')
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Updated!</h4>
                        <p>Ты успешно обновил свои данные!</p>
                        <hr>
                    </div>
                @endif
                @if ($errors->any)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ preg_replace('/A-Z/', '', $error) }}
                        </div>
                    @endforeach
                    @foreach ($jobs as $index => $job)
                        <form method="post" action="{{ route('addCandidate', ['jobId' => $job->id]) }}"
                            class="accordion-item">
                            @csrf
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                    aria-controls="collapse{{ $index }}">
                                    {{ $job->job }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse"
                                aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <h5 class="mb-2">Comptences Levels</h5>
                                    @foreach ($competences as $competence)
                                        @if ($job->id == $competence->job_id)
                                            <div class="components-item">
                                                <select name="{{ $competence->competence }}" class="form-select "
                                                    aria-label="Default select example">
                                                    <option
                                                        selected={{ true ? old($competence->competence) === 'Select' : false }}>
                                                        Select
                                                    </option>
                                                    @foreach ($levels as $level)
                                                        <option
                                                            selected={{ true ? old($competence->competence) === $level->level : false }}
                                                            value="{{ $level->level }}">
                                                            {{ $level->level }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <b>{{ $competence->competence }}</b>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Complete Name" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="E-mail" value="{{ old('email') }}">

                                        </div>
                                        <div class="col-6">
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone') }}"" placeholder="Phone Number">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-secondary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                @endif
            </div>
        </div>


    </main>
@include('footer')
