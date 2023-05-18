# Sơ bộ về Git
Để giới thiệu sơ bộ về Git, bạn có thể làm theo các bước sau:

Khởi tạo Git trong thư mục dự án của bạn với lệnh 

```
git init
```
Tạo một nhánh mới với lệnh 

```
git branch <branch_name>
```

Chuyển sang nhánh mới với lệnh 

```
git checkout <branch_name>
```

# Thực hiện một số thay đổi trên các tập tin trong thư mục của bạn.


Đưa các thay đổi vào khu vực chuẩn bị với lệnh 

```
git add <file> hoặc git add .
```

Commit các thay đổi với lệnh 

```
git commit -m "<commit_message>"
```
git push: Đưa các thay đổi từ kho lưu trữ cục bộ của bạn lên kho lưu trữ từ xa.

```
git push
```
git pull: Lấy các thay đổi từ kho lưu trữ từ xa và cập nhật kho lưu trữ cục bộ của bạn với các thay đổi đó.

```
git pull
```
Chuyển lại sang nhánh chính với lệnh 

```
git checkout main
```

Merge các thay đổi từ nhánh mới vào nhánh chính với lệnh 

```
git merge <branch_name>
```
# Các bước pull 

Save your changes to a temporary place using git stash save command:

``
git stash save "saving changes before pulling"
``
Perform a git pull to update your local branch with the changes from the remote branch:

``
git pull origin <branch_name>
``
Apply your changes using the git stash apply command:

``
git stash apply
``
Add the changes to the staging area using the git add command:

``
git add .
``
Commit the changes with a commit message:
``
git commit -m "Commit message"
``
Push the changes to the remote branch using the git push command:
``
git push
``
