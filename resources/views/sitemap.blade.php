{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Pages --}}
    @foreach($staticPages as $page)
        <url>
            <loc>{{ $page['url'] }}</loc>
            <lastmod>{{ now()->toDateString() }}</lastmod>
            <changefreq>{{ $page['changefreq'] }}</changefreq>
            <priority>{{ $page['priority'] }}</priority>
        </url>
    @endforeach

    {{-- Services --}}
    @foreach($services as $service)
        <url>
            <loc>{{ url('/services/' . $service->slug) }}</loc>
            <lastmod>{{ $service->updated_at ? $service->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    {{-- Industries --}}
    @foreach($industries as $industry)
        <url>
            <loc>{{ url('/industry/' . $industry->slug) }}</loc>
            <lastmod>{{ $industry->updated_at ? $industry->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Technologies --}}
    @foreach($technologies as $tech)
        <url>
            <loc>{{ url('/technology/' . $tech->slug) }}</loc>
            <lastmod>{{ $tech->updated_at ? $tech->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Case Studies --}}
    @foreach($caseStudies as $study)
        <url>
            <loc>{{ url('/case-studies/' . $study->slug) }}</loc>
            <lastmod>{{ $study->updated_at ? $study->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Blog Posts --}}
    @foreach($posts as $post)
        <url>
            <loc>{{ url('/blog/' . $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at ? $post->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Team Roles --}}
    @foreach($teamRoles as $role)
        <url>
            <loc>{{ url('/build-your-team/' . $role->slug) }}</loc>
            <lastmod>{{ $role->updated_at ? $role->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    {{-- Careers --}}
    @foreach($careers as $career)
        <url>
            <loc>{{ url('/careers/' . $career->id) }}</loc>
            <lastmod>{{ $career->updated_at ? $career->updated_at->toDateString() : now()->toDateString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
