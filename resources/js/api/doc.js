export function docTemplates() {
    return axios({
        method: 'get',
        url: '/doc/templates',
    })
}

export function getDocList(id) {
    id = id || 0;
    return axios({
        method: 'post',
        url: id === 0 ? '/folder' : '/folder/' + id,
    })
}

export function getDocs(params) {
    return axios({
        method: 'get',
        url: '/draftDocs',
        params,
    })
}

export function getPublishs(params) {
    return axios({
        method: 'get',
        url: '/publishDocs',
        params,
    })
}
export function newDoc(data) {
    return axios({
        method: 'post',
        url: '/draftDocs',
        data
    })
}

export function dupDoc(id) {
    return axios({
        method: 'post',
        url: '/draftDocs/' + id + '/duplicate',
    })
}

export function copyDoc(id, data) {
    return axios({
        method: 'post',
        url: '/draftDocs/' + id + '/copy',
        data
    })
}

export function shareDoc(id) {
    return axios({
        method: 'post',
        url: '/doc/share/' + id,
    })
}

export function editDoc(id, data) {
    return axios({
        method: 'put',
        url: '/draftDocs/' + id,
        data,
    })
}

export function moveDoc(srcId, destId) {
    const data = { dest: destId }
    return axios({
      url: '/draftDocs/' + srcId + '/move',
      method: 'put',
      data
    })
}

export function delDoc(id) {
    return axios({
        method: 'delete',
        url: '/draftDocs/' + id,
    })
}