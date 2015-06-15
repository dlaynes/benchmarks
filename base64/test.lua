-- you need to install an external library, for example: luarocks install lbase64
-- otherwise the test will take --ages-- when using hand-made functions
-- Well, the other languages are using native functions too :)
local base64 = require "base64"

strSize = 1000000
tries = 100

clockCbk = os.clock

i = 0
str = ""
str2 = ""

str = string.rep("a", strSize)

start = clockCbk()
s = 0

i = 0
while i < tries do
    str2 = base64.encode(str)
    s = s + string.len(str2)
    i = i+1
end
print( string.format("encode: %d, %f", s, clockCbk() - start ) )

i = 0
start = clockCbk()
while i < tries do
    s = s + string.len(base64.decode(str2))
    i = i+1
end
print( string.format("decode: %d, %f", s, clockCbk() - start ) )