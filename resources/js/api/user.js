export function userComments(params) {
    return axios({
      url: '/user/comments',
      method: 'get',
      params
    })
}
export function getNotices(params) {
  return axios({
    url: '/notices',
    method: 'get',
    params,
  })
}
export function getOrders(params) {
    return axios({
        method: 'get',
        url: '/user/orders',
        params,
    })
}
export function deleteOrder(id) {
    return axios({
        method: 'delete',
        url: '/orders/' + id,
    })
}
export function dopay(id) {
    return axios({
        method: 'get',
        url: '/pay',
        params: {
            oid: id
        }
    })
}

export function getRevenues(params) {
    return axios({
        method: 'get',
        url: '/user/revenues',
        params,
    })
}

export async function getUserInfo() {
    let userinfo = null;
    if (sessionStorage) {
        let sessData = sessionStorage.getItem('userinfo')
        if (sessData) {
            sessData = JSON.parse(sessData)
            if (sessData) {
                userinfo = sessData.userinfo
            }
        }
    }
    if (!userinfo) {
        const res = await axios({
            method: 'get',
            url: '/user/info',
        })
        userinfo = res.data
        sessionStorage.setItem('userinfo', JSON.stringify({
            userinfo
        }))
    }
    return userinfo
}

export function updateUser(data) {
    return axios({
        method: 'put',
        url: '/user',
        data,
    })
}

export function uploadAvatarUrl() {
    return '/upload/avatar'
}

export function getAddresses() {
  return axios({
    url: '/addresses',
    method: 'get',
  })
}
export function addAddress(data) {
    return axios({
      url: '/addresses',
      method: 'post',
      data
    })
}
export function updateAddress(id, data) {
    return axios({
        method: 'put',
        url: '/addresses/' + id,
        data,
    })
}
export function deleteAddress(id) {
    return axios({
        method: 'delete',
        url: '/addresses/' + id,
    })
}
export function findUsers(params) {
    return axios({
      url: '/user/find',
      method: 'get',
      params
    })
}