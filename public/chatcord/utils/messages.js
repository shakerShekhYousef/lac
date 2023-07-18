const moment = require('moment');

function formatMessage(username, text , type , userId , roleId,fileName) {
  return {
    username,
    text,
    type,
    userId,
    roleId,
    fileName,
    time: moment().format('h:mm a')
  };
}

module.exports = formatMessage;
