<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>Company News</title>
        @foreach($getRssFeed as $details)
        <item>
            <title>{{ @$details->title ?? '' }}</title>
            <link>{{ \App\Constants\AppConstants::PROCEPT_COM . @$details->url }}</link>
            <description><![CDATA[{!! @$details->fieldDataBody->body_summary !!}]]></description>
        </item>
        @endforeach
    </channel>
</rss>
