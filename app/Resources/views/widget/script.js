;!function(d){
    var iframe = d.createElement('iframe'),
        url = "{{ url }}",
        attributes = getIFrameAttributes();

    iframe.setAttribute("src", url);
    iframe.frameBorder = `${attributes.frameBorder}`;
    iframe.style.height = `${attributes.style.height}`;
    iframe.style.width = `${attributes.style.width}`;
    iframe.style.bottom = `${attributes.style.bottom}`;
    iframe.style.right = `${attributes.style.right}`;
    iframe.style.position = `${attributes.style.position}`;

    d.body.appendChild(iframe);
}(document);

function getIFrameAttributes()
{
    return {
        frameBorder: 0,
        style: {
            position: 'fixed',
            bottom: 0,
            right: 0,
            height: '100px',
            width: '100px'
        }
    };
}