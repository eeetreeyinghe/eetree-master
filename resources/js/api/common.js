export function getEnums(key, t = '') {
  return axios({
    url: '/common/enums',
    method: 'get',
    params: { term: key, t }
  })
}

// 查找标签
export function findTags(q) {
  return axios({
    url: '/tag/find?q='+q,
    method: 'get'
  })
}