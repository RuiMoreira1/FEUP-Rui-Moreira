import Distribution.Simple.Utils (xargs)
{- Exercise 1.1 Pratical sheet 1 -}

testaTriangulo :: Float -> Float -> Float -> Bool 
testaTriangulo a b c
    | a >= b + c = False 
    | b >= c + a = False 
    | c >= a + b = False 
    | otherwise = True

{- Exercise 1.2 Pratical sheet 1 -}

areaTriangulo :: Float -> Float -> Float -> Float 
areaTriangulo a b c = sqrt (s*(s-a)*(s-b)*(s-c))
    where s = (a+b+c)/2


{- Exercise 1.3 Pratical sheet 1 -}

metades :: [a] -> ([a],[a])
metades x = (take l x, drop l x)
    where l = length x `div` 2

metades' :: [a] -> ([a],[a])
metades' x = splitAt l x
    where l = length x `div` 2

{- Exercise 1.4 a) Pratical sheet 1 -}

last' :: [a] -> a
last' x =  head (take 1 (reverse x)) 

last'' :: [a] -> a
last'' x = let l = length x - 1 in head (drop l x) 

{- Exercise 1.4 b) Pratical sheet 1 -}

init' :: [a] -> [a]
init' x = reverse (tail (reverse x))

init'' :: [a] -> [a]
init'' x = reverse (drop 1 (reverse x))

{- Exercise 1.5 a) Pratical sheet 1 -}

binom :: Integer -> Integer -> Integer 
binom a b = product [1..a] `div`  (product[1..b] * product[1..(a-b)] )

{- Exercise 1.5 b) Pratical sheet 1 -}

binom2 :: Integer -> Integer -> Integer
binom2 a b
    | b < a - b = product[1..(a-b+1)] `div` product[1..b]
    | otherwise = product[b+1..a] `div` product[1..(a-b)]



