echo Crystal
../xtime.rb ./json_cr
echo Crystal Pull
../xtime.rb ./json_pull_cr
echo Crystal Schema
../xtime.rb ./json_schema_cr
echo Javascript Node
../xtime.rb nodejs test.js
echo Ruby
../xtime.rb ruby test.rb
echo Rust
../xtime.rb ./json_rs
echo Go
../xtime.rb ./json_go
echo GccGo
../xtime.rb ./json_go_gccgo
echo D
../xtime.rb ./json_d
echo D Gdc
../xtime.rb ./json_d_gdc
echo D Ldc
../xtime.rb ./json_d_ldc
echo Nim Gcc
../xtime.rb ./json_nim_gcc
echo Nim Clang
../xtime.rb ./json_nim_clang
echo PHP
../xtime.rb php test.php
echo Python Pypy
../xtime.rb pypy test.py
echo Python
../xtime.rb python test.py
echo C++ Boost
../xtime.rb ./json_boost_cpp
echo C++ Rapid
../xtime.rb ./json_rapid_cpp
echo C++ Gason
../xtime.rb ./json_gason_cpp
echo C++ LibJson
../xtime.rb ./json_libjson_cpp
echo Julia
../xtime.rb julia test.jl
echo Mono
../xtime.rb mono -O=all --gc=sgen test.exe
echo Scala
../xtime.rb scala -J-Xmx3024m TestJson