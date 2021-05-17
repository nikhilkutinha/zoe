import moment from 'moment'

export const relativeTime = date => {
  return moment(date).fromNow()
}

export const clipboard = async text => {
  await navigator.clipboard.writeText(text)
}
