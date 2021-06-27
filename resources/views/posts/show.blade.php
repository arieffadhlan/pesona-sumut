@extends('layouts.app', ['title' => $post->title . ' - Pesona Sumut'])

@section('title', $post->title)
@section('content')
     <div class="container">
          <div class="row">
               <div class="col-md-8">
                    @if ($post->thumbnail)
                         <img style="height: 400px; object-fit: cover; object-position: top;" class="rounded w-100"
                              src="{{ url($post->takeImage) }}">
                    @endif
                    <h1 class="mt-3">{{ $post->title }}</h1>
                    <div class="text-secondary mb-3">
                         <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
                         &middot; {{ $post->created_at->format('d F, Y') }}
                         &middot;
                         @foreach ($post->tags as $tag)
                              <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
                         @endforeach
                         <div class="media my-3">
                              <img width="60" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}" alt="">
                              <div class="media-body">
                                   <div>
                                        {{ $post->author->name }}
                                   </div>
                                   {{ '@' . $post->author->username }}
                              </div>
                         </div>
                    </div>

                    <div class="text-justify overflow-hidden">
                         <p>{!! nl2br($post->body) !!}</p>
                    </div>
                    <div>
                         @can('delete', $post)
                              <!-- Button trigger modal -->
                              <div class="d-flex justify-content-between  position-absolute">
                                   <div>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                             data-target="#exampleModal">
                                             Delete
                                        </button>
                                        <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                   </div>
                              </div>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                   aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapusnya?
                                                  </h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                  </button>
                                             </div>
                                             <div class="modal-body">
                                                  <div class="mb-2">
                                                       <div>{{ $post->title }}</div>
                                                       <div class="text-secondary">
                                                            <small>
                                                                 Published: {{ $post->created_at->format('d F, Y') }}
                                                            </small>
                                                       </div>
                                                  </div>
                                                  <form action="/posts/{{ $post->slug }}/delete" method="post">
                                                       @csrf
                                                       @method('delete')
                                                       <div class="d-flex justify-content-end">
                                                            <button class="btn btn-danger mr-2" type="submit">Ya</button>
                                                            <button type="button" class="btn btn-success"
                                                                 data-dismiss="modal">Tidak</button>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         @endcan
                         <div class="d-flex justify-content-end mt-3">
                              <a href="/kursi" class="btn btn-sm btn-success">Order</a>
                         </div>
                    </div>
               </div>

               <div class="col-md-4">
                    @foreach ($posts as $post)
                         <div class="card mb-4">
                              <div class="card-body">
                                   <div>
                                        <a href="{{ route('categories.show', $post->category->slug) }}"
                                             class="text-secondary">
                                             <small>{{ $post->category->name }} - </small>
                                        </a>

                                        @foreach ($post->tags as $tag)
                                             <a href="{{ route('tags.show', $tag->slug) }}" class="text-secondary">
                                                  <small>{{ $tag->name }}</small>
                                             </a>
                                        @endforeach

                                   </div>

                                   <h5>
                                        <a class="text-dark" href="{{ route('posts.show', $post->slug) }}"
                                             class="card-title">
                                             {{ $post->title }}
                                        </a>
                                   </h5>

                                   <div class="text-secondary my-3">
                                        {!! nl2br(Str::limit($post->body, 130, '.')) !!}
                                   </div>
                                   <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                             <div class="media align-items-center">
                                                  <img width="40" class="rounded-circle mr-3"
                                                       src="{{ $post->author->gravatar() }}" alt="">
                                                  <div class="media-body">
                                                       <div>
                                                            {{ $post->author->name }}
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endforeach
               </div>
          </div>
     </div>
@endsection
