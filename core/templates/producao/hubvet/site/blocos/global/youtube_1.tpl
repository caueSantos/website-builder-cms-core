<section class="galeria-youtube">
    <div class="row">
        
        {foreach from=youtube_channel_videos($galeria[0]->Youtube_txf, {$max_results|default:15}) item=video}
            <div class="col-lg-4">
                <article class="video">
                    <a href="https://www.youtube.com/watch?v={$video->id->videoId}" target="_blank">
                        <figure class="imagem">
                            <img class="img-fluid" src="{$video->snippet->thumbnails->medium->url}">
                        </figure>
                    </a>
                    <div class="titulo">
                        <a href="https://www.youtube.com/watch?v={$video->id->videoId}" target="_blank">
                            {$video->snippet->title}
                        </a>
                    </div>
                    <div class="canal">
                        <a href="https://www.youtube.com/watch?v={$video->id->videoId}" target="_blank">
                            {$video->snippet->channelTitle}
                        </a>
                    </div>
                    <div class="data">
                        <a href="https://www.youtube.com/watch?v={$video->id->videoId}" target="_blank">
                            {date('d/m/Y H\hi', strtotime($video->snippet->publishedAt))}
                        </a>
                    </div>
                </article>
            </div>
        {/foreach}
    </div>
</section>