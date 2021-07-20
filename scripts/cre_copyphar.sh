src_dest="/var/lib/jenkins/workspace/tasks_freestyle"
build="/var/www/html/phar/copyphar"

echo "build="$build
echo "src_dest="$src_dest

if [ -d "$build" ]
then
	echo "The build dir exists"
	rm -rf $build/*
else
	echo "The build dir does not exist;creating it...."
	mkdir $build
fi

cp -R $src_dest/src $build/.
cp $src_dest/index.php $build
