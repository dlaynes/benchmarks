
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

function Set (list)
  local set = {}
  for _, l in ipairs(list) do set[l] = true end
  return set
end

-- 

local tapePos = 1
local tape = {0}

-- local code = ""
local bracket_map = {}

function tape_inc()
    tape[tapePos] = tape[tapePos] + 1
end

function tape_dec()
    if tape[tapePos] > 0 then
        tape[tapePos] = tape[tapePos] - 1
    end
end

function tape_advance()
    tapePos = tapePos + 1
    if tapePos > #tape then
        table.insert (tape, 0)
    end
end

function tape_devance()
    if tapePos > 1 then
        tapePos = tapePos - 1
    end
end

function tape_get()
    return tape[tapePos]
end

function create_program(program)
    local code = ""
    local leftstack = {}
    local pc, left, right = 1, 0, 0

    -- print "In program \n"

    for c in program:gmatch "." do

        -- print ( "adding " .. c .. "\n" )
        local characters = Set{'+','-','<','>','.',',','[',']'}

        if characters[c] then
            code = code .. c
            
            if c == '[' then
                table.insert (leftstack, pc)

                -- print ("inserting " .. left .. "\n")

            elseif c == ']' and #leftstack > 0 then
                left = table.remove(leftstack)

                -- print ("removing " .. left .. "\n")

                right = pc

                bracket_map[right] = left
                bracket_map[left] = right

            end
            pc = pc + 1
        end
    end

    run_program(code)

end

function run_program(code)
    local pc = 1
    
    -- print "In run program \n"

    for c in code:gmatch "." do
        -- print ( "running " .. c .. "\n" )

        if c == "+" then
            tape_inc()
        elseif c == "-" then
            tape_dec()
        elseif c == ">" then
            tape_advance()
        elseif c == "<" then
            tape_devance()
        elseif c == "[" then
            if tape_get() == 0 then
                pc = bracket_map[pc]
            end
        elseif c == "]" then
            if tape_get() ~= 0 then
                pc = bracket_map[pc]
            end
        elseif c == "." then
            print( string.char(tape_get() ) )
        else
            break
        end
        pc = pc + 1
    end
end

if arg[1] ~= nil then
    local cd = lines_from(arg[1])
    local prg = ""

    for i, v in ipairs(cd) do 
        prg = prg .. v
    end
    create_program( prg )
end
