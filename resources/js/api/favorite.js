export function getFavorites(params) {
    return axios({
        method: 'get',
        url: '/favorites',
        params,
    })
}

export function addFavorite(data) {
    return axios({
        method: 'post',
        url: '/favorites',
        data
    })
}

export function cancelFavorite(id) {
    return axios({
        method: 'delete',
        url: '/favorites/' + id,
    })
}