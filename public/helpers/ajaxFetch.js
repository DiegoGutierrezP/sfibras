export default async function ajaxFetch(options) {
    let {url,ops,success,error} = options;
    try {
        let res = await fetch(url, ops),
            json = await res.json();

        if (!res.ok) throw {
            status: res.status,
            statusText: res.statusText
        };
        //console.log(json);
        success(json);
    } catch (err) {
        console.log(err);
        error(err);
    }
}
