export function getCategoryList() {
    return axios({
        method: 'get',
        url: '/userCategories',
    })
}

export function newCategory(data) {
    return axios({
        method: 'post',
        url: '/categories',
        data,
    })
}

export function editCategory(id, data) {
    return axios({
        method: 'put',
        url: '/categories/' + id,
        data,
    })
}

export function delCategory(id) {
    return axios({
        method: 'delete',
        url: '/categories/' + id,
    })
}

export function moveCategory(srcId, destId) {
    const data = { dest: destId }
    return axios({
      url: '/categories/' + srcId + '/move',
      method: 'put',
      data
    })
}