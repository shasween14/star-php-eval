@extends('layout')

@section('title', 'Latest News')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Latest News</h1>
        <p class="text-secondary mb-0">Stories from around the world.</p>
    </div>
    <input type="search" id="search" class="form-control w-auto" style="min-width: 280px;"
        placeholder="Search articles...">
</div>

<div class="row g-4" id="article-lists"></div>

<script>
    fetchArticles();

    let timeout = null
    const searchInput = document.getElementById("search");
    const htmlLists = document.getElementById("article-lists");
    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => fetchArticles(this.value.trim()), 300);
    });

    async function fetchArticles(search = null){
        const params = new URLSearchParams();

        if(search){
            params.set("search", search);
        }

        const response = await fetch(`{{ url('/') }}/api/articles?${params}`,{
            headers: {'Accept': 'application/json'}
        });

        if (!response.ok) throw new Error(`Request failed: ${response.status}`);

        const json = await response.json();
        renderArticleLists(json.data);
    }

    function renderArticleLists(articles){
        if(articles.length === 0){
            htmlLists.innerHTML = '<p class="text-center text-secondary py-5">No articles match your search.</p>';
            return;
        }

        htmlLists.innerHTML = articles.map(article => `
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm article-card">
                    <div class="card-body d-flex flex-column p-4">
                        <span class="badge text-bg-primary align-self-start mb-2">${escapeHtml(article.category.name)}</span>
                        <h2 class="h5 fw-semibold">
                            <a href="{{ url('/articles') }}/${encodeURIComponent(article.permalink)}"
                               class="text-reset text-decoration-none stretched-link">${escapeHtml(article.title)}</a>
                        </h2>
                        <p class="text-secondary small">${escapeHtml(article.summary)}</p>
                        <div class="mt-auto small text-secondary">${escapeHtml(article.author)} &middot; ${escapeHtml((article.published_at ?? '').slice(0, 10))}</div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
</script>
@endsection