SELECT
    AlgCat.IdAlgCat,
    AlgCat.IdAlgCatPar,
    AlgCat.Nam,
    AlgCat.Descr,
    AlgCatPar.Nam AS AlgCatParNam
FROM
    AlgCat
LEFT OUTER JOIN AlgCat AlgCatPar ON AlgCat.IdAlgCatPar = AlgCatPar.IdAlgCat
WHERE
    AlgCat.IdAlgCat IN('26')
ORDER BY
    AlgCat.Nam;

-- old
SELECT
	p.IdAlgCat,
	p.IdAlgCatPar,
	pp.Nam AS AlgCatParNam,
	p.Nam,
	p.Descr
FROM
	AlgCat p
	LEFT OUTER JOIN AlgCat pp ON p.IdAlgCatPar = pp.IdAlgCat
where p.IdAlgCat='26';