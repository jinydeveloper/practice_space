# error

1. git add 명령어 입력했을 때 오류 발생
- 오류 : 
warning: in the working copy of 'README.md', 
LF will be replaced by CRLF the next time Git touches it

- 원인 :
git이 파일을 업데이트 할 때, LF(Line Feed) 줄바꿈 문자가
CRLF(Carriage Return Line Feed) 줄바꿈 문자로 대체될 것임을 나타내는 경고

- 해결 :
git이 CRLF 대신 LF를 사용하도록 강제로 설정을 변경해주는 것
$ git config --global core.autocrlf true