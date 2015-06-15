-- https://github.com/prapin/LuaBrainFuck/blob/master/brainfuck.lua
function parser(s)
    local subst = {
        ["+"]="v=v+1 ", 
        ["-"]="v=v-1 ",
        [">"]="i=i+1 ",
        ["<"]="i=i-1 ",
        ["."] = "w(v)",
        [","]="v=r()",
        ["["]="while v~=0 do ",
        ["]"]="end "
    }
    local env = setmetatable({
        i=0,
        t=setmetatable({},{__index=function() return 0 end}),
        r = function()
            return io.read(1):byte()
        end,
        w = function(c)
            io.write(string.char(c)) end
        }, 
        {__index=function(t,k) return t.t[t.i] end, __newindex=function(t,k,v) t.t[t.i]=v end
    })
    local fn, err =load(
        s:gsub("[^%+%-<>%.,%[%]]+","")
            :gsub(".", subst), "brainfuck", "t", env
    )
    if err == nil then
        fn()
    else 
        print(err)
    end
end

-- file functions
function file_exists(file)
  local f = io.open(file, "rb")
  if f then f:close() end
  return f ~= nil
end

-- get all lines from a file, returns an empty 
-- list/table if the file does not exist
function lines_from(file)
  if not file_exists(file) then return {} end
  lines = {}
  for line in io.lines(file) do 
    lines[#lines + 1] = line
  end
  return lines
end

if arg[1] ~= nil then
    local cd = lines_from(arg[1])
    local prg = ""

    for i, v in ipairs(cd) do 
        prg = prg .. v
    end
    parser( prg )
end
