import config from '@/js/utils/config'

export async function getToken(type = 'img') {
  let token = null;
  if (sessionStorage) {
    let sessData = sessionStorage.getItem('qiniu-token' + type)
    if (sessData) {
      const now = new Date().getTime();
      sessData = JSON.parse(sessData)
      if (sessData && now - sessData.start < 300000) {
        token = sessData.token
      }
    }
  }
  if (!token) {
    const res = await axios({
      url: '/common/qnUploadToken',
      method: 'get',
      params: {type}
    })
    token = res.data.token
    sessionStorage.setItem('qiniu-token' + type, JSON.stringify({
      start: new Date().getTime(),
      token
    }))
  }
  return token
}

export function qnUpload(formData) {
  return axios({
    method: 'POST',
    url: config.qiniu.uploadUrl,
    data: formData,
  })
}
